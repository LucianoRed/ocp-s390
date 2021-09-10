FROM centos:7
RUN yum -y install epel-release && yum update -y
RUN yum install -y ansible httpd
RUN yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN yum-config-manager --enable remi-php74
RUN yum install -y php php-common php-opcache php-mcrypt php-cli php-gd php-curl php-mysql -y
RUN yum install -y PyYAML python2-openshift
#RUN yum install -y python-pip
#RUN pip install --upgrade pip
#RUN pip install --upgrade openshift
COPY ansible/assets/httpd.conf /etc/httpd/conf/httpd.conf
RUN chmod 777 /var/run/httpd/ /run/httpd /etc/httpd/logs/ && mkdir /.ansible && chmod -R 777 /.ansible && mkdir /playbooks && chmod 777 /playbooks
COPY ansible/playbooks/ /playbooks/
COPY src/ /var/www/html
RUN useradd ansible -u 12345
USER 12345
EXPOSE 8080
CMD ["/usr/sbin/httpd","-D","FOREGROUND"]