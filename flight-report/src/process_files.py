import xml.etree.ElementTree as ET
import sys
import logging
from sets import Set
import csv
from os.path import basename
import os, glob

logging.basicConfig(stream=sys.stderr, level=logging.INFO)

def getInputfiles(inputfolder):
    files = []
    logging.info("inputfolder:%s", inputfolder)
    for file in os.listdir(inputfolder):
        if file.endswith(".xml"):
            fname=os.path.join(inputfolder, file)
            print(fname)
            files.append(fname)
    return files

class CsvWriter:
    def __init__(self, filename, outfolder):
        self.infilename = filename
        self.outfolder = outfolder
        self.filename = outfolder + "/" + basename(filename) + ".csv"
        try:
            os.remove(self.filename)
        except:
            logging.warn("file not found: %s", self.filename)
        try:
            os.stat(self.outfolder)
        except:
            logging.info("output folder not found, creating output folder")
            os.mkdir(self.outfolder)   

    def numlines(self, filename):
        l=0
        with open(filename) as f:
            l=sum(1 for _ in f)
        print "lines:", l
        return l

    def writeheader(self, header):
        with open(self.filename, "a") as csv_file:
            writer = csv.writer(csv_file, delimiter=',')
            writer.writerow(header)
            logging.debug("writing header=%s", header)

    def write(self, values):
        with open(self.filename, "a") as csv_file:
            writer = csv.writer(csv_file, delimiter=',')
            for row in values:
                logging.debug("values=%s", values)
                #str1 = ','.join(values)
                try:
                    writer.writerow(row)
                except:
                    logging.error("unable to write row %s. skipping ...", row)
                    continue


infolder=sys.argv[1]
outfolder=sys.argv[2]

files=getInputfiles(infolder)
logging.info("input files:%s", files)

for filename in files:
    csvWriter=CsvWriter(filename, outfolder)
    rowcount=0
    headerdone=False
    try:
        tree = ET.parse(filename)
    except:
        logging.error("filed to parse file % ", filename)
        continue
    taglist = []
    row=[]
    csvdata=[]

    for elem in tree.iter():
        logging.debug("<%s> %s", elem.tag, elem.text)
        rowcount = rowcount+1
        if(elem.tag == "row" and len(row) > 1 ):
            logging.debug("valuesi before=%s", row)
            # csvWriter.write(row)
            csvdata.append(row)
            row = []
            if not headerdone:
                csvWriter.writeheader(taglist)
                headerdone=True
        
        if(elem.text != None):
            row.append(elem.text)
            if not headerdone:
                taglist.append(elem.tag)

        #logging.info("rows processed:%d", rowcount)
        sys.stdout.write("processing:\r%d:" % rowcount)
        sys.stdout.flush()

    csvWriter.write(csvdata)
    logging.info("finished processing %s", filename)
    logging.info("records processed:%d", rowcount)
    logging.info("all tags: %s", taglist)

logging.info("finished processing all input files. output files are generated %s", outfolder)

