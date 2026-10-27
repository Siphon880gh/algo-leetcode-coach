## Tiny example

```
      1
     / \
    2   3
   /
  4
```

- The root `1` has left child `2` and right child `3`.
- Node `2` has left child `4` and no right child.
- Node `4` has no children, so it is a leaf.

Every node has **at most two children**, called left and right. This shape is behind binary search trees, heaps, expression trees and many interview problems.

## Vocabulary

1. **Root**: the top node.
2. **Leaf**: a node with no children.
3. **Height and depth**: the number of edges on the longest path. Books differ by one here, so pick a definition and stay consistent.
4. **Parent, child and sibling**: how nodes relate through edges.

## Trap

Drawing a "binary tree" where one node has three children. That is a general tree, not a binary tree.

**Fix:** A binary tree has only a left slot and a right slot. If you need more children, use a general tree, or encode it with first-child and next-sibling links.

**Time to visit every node once:** O(n)  
**Space:** O(n) for the nodes, plus O(h) for the recursion stack

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
