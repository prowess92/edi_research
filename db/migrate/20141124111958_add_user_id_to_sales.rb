class AddUserIdToSales < ActiveRecord::Migration
  def self.up
    add_column :sales, :user_id, :integer
    add_column :items, :user_id, :integer
    add_column :stocks, :user_id, :integer
  end

  def self.down
    remove_column :sales, :user_id
    remove_column :items, :user_id
    remove_column :stocks, :user_id 
  end
end
