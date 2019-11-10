# analyse_string.py
#!/usr/bin/python

import sys

#data from backend
data = str(sys.argv[1]).split(';')

#prediction
print(data[0]+data[1])

