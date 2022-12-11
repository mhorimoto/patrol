#! /usr/bin/env python3
# -*- coding: utf-8 -*-
import time
import urllib.parse
import urllib.request
import configparser

from pyA20.gpio import gpio
from pyA20.gpio import port
from pyA20.gpio import connector

def send_trig(h,u,p):
    trigval = {}
    trigval = {'P':p,'H':h}
    params = urllib.parse.urlencode(trigval)
    params = params.encode('ascii')
    urlreq = urllib.request.Request(u,params)
    with urllib.request.urlopen(urlreq) as urlresponse:
        the_page = urlresponse.read()


config = configparser.ConfigParser()
config.read('/etc/uecs/patrol.ini',encoding="utf-8")

toserv = config['URL']['server']
myname = config['HOST']['name']

pa7c = 0
ppa7c = 0
pg8c = 0
ppg8c = 0
gpio.init()
gpio.setcfg(port.PG8,gpio.INPUT)
gpio.pullup(port.PG8, gpio.PULLUP)
gpio.setcfg(port.PA7,gpio.INPUT)
gpio.pullup(port.PA7, gpio.PULLUP)
while True:
    if (pg8c>=5):
        pg8c = 0
    pa7v = gpio.input(port.PA7)
    pg8v = gpio.input(port.PG8)
    if (pg8v==0):
        pg8c = 0
    else:
        pg8c += pg8v
    if pg8c==0:
        if (ppg8c!=2):
            ppg8c = 2
            print("Power fail.")
            send_trig(myname,toserv,"PF")
    else:
        if (ppg8c!=1) and (pg8c==5):
            ppg8c = 1
            print("Power recover.")
            send_trig(myname,toserv,"PR")
    if (ppa7c!=1) and (pa7v==0):
        ppa7c = 1
        print("Door close")
        send_trig(myname,toserv,"DC")
    if (ppa7c!=2) and (pa7v==1):
        ppa7c = 2
        print("Door Open")
        send_trig(myname,toserv,"DO")
    time.sleep(1)


