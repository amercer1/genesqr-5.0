#!/usr/bin/ruby

#This will swap out arguement 0 for the url on which the php code will be hosted

# Then set the variables for find/replace
@original_string_or_regex = /(URLHERE)/
@replacement_string = ARGV[0] 

Dir.open(Dir.pwd).each do |file_name|
  if !File.directory? file_name
     text = File.read(file_name)
     replace = text.gsub!(@original_string_or_regex, @replacement_string)
     if(file_name =="job.php" and replace !=nil)
       File.open("job.php", "w") { |file| file.puts replace }
     end
  end
end

# This will swap out arguemnt 1 for the email address.

@original_mail = /(mailAddress)/
@replacement_mail = ARGV[1] 
Dir.open(Dir.pwd).each do |file_name|
  if !File.directory? file_name
     text = File.read(file_name)
     replace = text.gsub!(@original_mail, @replacement_mail)
     if(file_name =="done.php" and replace != nil)
       File.open("done.php", "w") { |file| file.puts replace }
     end
  end
end
