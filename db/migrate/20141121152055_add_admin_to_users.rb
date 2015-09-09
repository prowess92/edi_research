class AddAdminToUsers < ActiveRecord::Migration
  def self.up
    add_column :users, :admin, :boolean, :default => false
    add_column :users, :profile, :text
  end

  def self.down
    remove_column :users, :admin
    remove_column :users, :profile
  end
end
