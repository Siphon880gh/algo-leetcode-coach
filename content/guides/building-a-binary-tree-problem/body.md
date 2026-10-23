## Tiny example

Preorder: `[3,9,20,15,7]`  
Inorder:  `[9,3,15,20,7]`

1. Preorder first value `3` is the root
2. Inorder split: left `[9]`, right `[15,20,7]`
3. Recurse: left preorder chunk `[9]`; right `[20,15,7]` …

Rebuilds the unique tree (when values are unique).


## How

1. Root = first of current preorder segment
2. Locate root in inorder → left/right sizes
3. Recurse on sliced segments (or index ranges)


## Trap

Assuming preorder alone uniquely rebuilds any binary tree.

**Fix:** You need inorder (or another complementary traversal) to know left/right sizes.

**Time:** O(n) with a hash of inorder indices · **Space:** O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
