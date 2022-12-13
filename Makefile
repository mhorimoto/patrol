install: /usr/local/bin/patrol.py /etc/uecs/patrol.ini
	install patrol.py /usr/local/bin
	cp patrol.service /etc/systemd/system

/etc/uecs/patrol.ini: patrol.ini
	-mkdir /etc/uecs
	-/bin/cp /etc/uecs/patrol.ini /etc/uecs/patrol.ini-bak
	/bin/cp patrol.ini /etc/uecs
