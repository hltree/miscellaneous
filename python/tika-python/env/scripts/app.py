#!/usr/bin/env python
import tika
from tika import parser
tika.initVM()

parsed = parser.from_file('/env/pdfs/target.pdf')
print(parsed["metadata"])
print(parsed["content"])
