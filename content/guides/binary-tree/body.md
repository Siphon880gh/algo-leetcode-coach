## Tiny example

```
      1
     / \
    2   3
   /
  4
```

- Root `1` has left `2` and right `3`
- Node `2` has left `4` and right empty
- Node `4` is a leaf

Every node has **at most two children** (left and right). That shape underpins BSTs, heaps, expression trees, and many interview problems.

## Vocabulary

1. **Root** — top node
2. **Leaf** — both children empty
3. **Height / depth** — edges on the longest path (definitions vary by ±1; pick one and stay consistent)
4. **Parent / child / sibling** — edge relationships

## Trap

Drawing a “binary tree” with three children on one node — that is a general tree, not binary.

**Fix:** Left and right slots only. If you need more children, use a general tree or left-child/right-sibling encoding.

**Time (visit every node once):** O(n)  
**Space:** O(n) nodes; recursion stack O(h)

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
