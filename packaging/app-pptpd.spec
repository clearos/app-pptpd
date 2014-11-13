
Name: app-pptpd
Epoch: 1
Version: 1.6.7
Release: 1%{dist}
Summary: PPTP Server
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base
Requires: app-accounts
Requires: app-incoming-firewall
Requires: app-groups
Requires: app-users
Requires: app-network

%description
PPTP VPN allows users to connect to your network using a VPN client common to most operating systems.  PPTP is easy and useful for road warriors but is considered less secure than other technologies like OpenVPN.

%package core
Summary: PPTP Server - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: app-events-core
Requires: app-network-core >= 1:1.4.5
Requires: app-pptpd-plugin-core
Requires: app-samba-common-core
Requires: pptpd >= 1.3.4
Requires: ppp >= 2.4.5-5.v6
Requires: system-windows-driver

%description core
PPTP VPN allows users to connect to your network using a VPN client common to most operating systems.  PPTP is easy and useful for road warriors but is considered less secure than other technologies like OpenVPN.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/pptpd
cp -r * %{buildroot}/usr/clearos/apps/pptpd/

install -d -m 0755 %{buildroot}/etc/clearos/pptpd.d
install -d -m 0755 %{buildroot}/var/clearos/pptpd
install -d -m 0755 %{buildroot}/var/clearos/pptpd/backup
install -D -m 0644 packaging/authorize %{buildroot}/etc/clearos/pptpd.d/authorize
install -D -m 0755 packaging/network-configuration-event %{buildroot}/var/clearos/events/network_configuration/pptpd
install -D -m 0755 packaging/network-peerdns-event %{buildroot}/var/clearos/events/network_peerdns/pptpd
install -D -m 0644 packaging/pptpd.conf %{buildroot}/etc/clearos/pptpd.conf
install -D -m 0644 packaging/pptpd.php %{buildroot}/var/clearos/base/daemon/pptpd.php
install -D -m 0755 packaging/samba-configuration-event %{buildroot}/var/clearos/events/samba_configuration/pptpd

%post
logger -p local6.notice -t installer 'app-pptpd - installing'

%post core
logger -p local6.notice -t installer 'app-pptpd-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/pptpd/deploy/install ] && /usr/clearos/apps/pptpd/deploy/install
fi

[ -x /usr/clearos/apps/pptpd/deploy/upgrade ] && /usr/clearos/apps/pptpd/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-pptpd - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-pptpd-core - uninstalling'
    [ -x /usr/clearos/apps/pptpd/deploy/uninstall ] && /usr/clearos/apps/pptpd/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/pptpd/controllers
/usr/clearos/apps/pptpd/htdocs
/usr/clearos/apps/pptpd/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/pptpd/packaging
%dir /usr/clearos/apps/pptpd
%dir /etc/clearos/pptpd.d
%dir /var/clearos/pptpd
%dir /var/clearos/pptpd/backup
/usr/clearos/apps/pptpd/deploy
/usr/clearos/apps/pptpd/language
/usr/clearos/apps/pptpd/libraries
%config(noreplace) /etc/clearos/pptpd.d/authorize
/var/clearos/events/network_configuration/pptpd
/var/clearos/events/network_peerdns/pptpd
%config(noreplace) /etc/clearos/pptpd.conf
/var/clearos/base/daemon/pptpd.php
/var/clearos/events/samba_configuration/pptpd
