#FROM registry.access.redhat.com/rhel7.9:7.9-476
FROM registry.access.redhat.com/ubi8:8.4-209
COPY assets/iperf3-3.5-6.el8.s390x.rpm /tmp/iperf3-3.5-6.el8.s390x.rpm
RUN yum install /tmp/iperf3-3.5-6.el8.s390x.rpm
#RUN yum install -y net-tools tcpdump iperf3 httpd
USER 1001
CMD ["sleep", "32132131231"] 
