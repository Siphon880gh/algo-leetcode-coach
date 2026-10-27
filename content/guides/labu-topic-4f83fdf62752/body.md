## Tiny example

Tree vocabulary, using this tree:

```
      1
     / \
    2   3
   /
  4
```

- **Depth** of node 4: 2, counting the edges from the root.
- **Height** of the tree: 2, the number of edges on the longest path from the root to a leaf.
- **Perfect, full and complete** are different shape rules. A complete tree has the heap shape. A perfect tree has every level full.

Interviewers often ask follow-up questions using these words, so keep your definitions consistent.

## How

1. Choose whether you count edges or nodes, and stick to it.
2. Classify shape words carefully.
3. Use complete-tree array indexing only when the tree really has that shape.

## Trap

Calling any bushy tree "complete".

**Fix:** A complete tree is filled level by level, with the last level packed to the left. That is the heap shape.

**Note:** textbooks define these words slightly differently, so state the definition you are using.

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
