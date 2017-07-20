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

    def write(self, values):
        with open(self.filename, "a") as csv_file:
            writer = csv.writer(csv_file, delimiter=',')
            logging.debug("values=%s", values)
            #str1 = ','.join(values)
            writer.writerow(values)

infolder=sys.argv[1]
outfolder=sys.argv[2]

files=getInputfiles(infolder)
logging.info("input files:%s", files)

for filename in files:
    csvWriter=CsvWriter(filename, outfolder)
    rowcount=0
    tree = ET.parse(filename)
    tagset = Set()
    row=[]

    for elem in tree.iter():
        logging.debug("<%s> %s", elem.tag, elem.text)
        rowcount = rowcount+1
        if(elem.tag == "row" and len(row) > 1 ):
            logging.debug("valuesi before=%s", row)
            csvWriter.write(row)        
            row = []
        
        if(elem.text != None):
            row.append(elem.text)
        tagset.add(elem.tag)
        #logging.info("rows processed:%d", rowcount)
        sys.stdout.write("processing:\r%d:" % rowcount)
        sys.stdout.flush()

    logging.info("finished processing %s", filename)
    logging.info("records processed:%d", rowcount)
    logging.info("all tags: %s", tagset)

logging.info("finished processing all input files. output files are generated %s", outfolder)

