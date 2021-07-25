Vagrant.configure("2") do |config|
	config.vm.define "course16" do |cfg|
		cfg.vm.box = "centos/7"
		cfg.vm.hostname = "mysite.local"
		cfg.vm.network :private_network, ip: "192.168.111.67"
		cfg.ssh.username = 'vagrant'
		cfg.ssh.password = 'vagrant'
		cfg.ssh.insert_key = false		
	    cfg.vm.provider "virtualbox" do |v|
			v.gui = true
			v.name = "course16"
			v.memory = "2000"
			v.cpus = "1"
		end
	end
end