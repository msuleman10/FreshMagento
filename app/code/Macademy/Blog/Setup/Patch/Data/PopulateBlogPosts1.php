<?php declare(strict_types=1);

namespace Macademy\Blog\Setup\Patch\Data;

use Macademy\Blog\Model\PostFactory;
use Macademy\Blog\Api\PostRepositoryInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class PopulateBlogPosts1 implements DataPatchInterface
{
    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private PostFactory $postFactory,
        private PostRepositoryInterface $postRepository
    ){}

    public static function getDependencies():array
    {
        return [];
    }

    public function getAliases():array
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $posts=[
            [
                'title'=>'iam hello',
                'content'=>'why iam hai?'
            ],[
                'title'=>'iam hai',
                'content'=>'why iam hello?'
            ],[
                'title'=>'iam by',
                'content'=>'why iam by one?'
            ]
        ];
        foreach ($posts as $postsValue){
            $post=$this->postFactory->create();
            $post->setData($postsValue);
            $this->postRepository->save($post);
        }
        $this->moduleDataSetup->endSetup();

    }
}
