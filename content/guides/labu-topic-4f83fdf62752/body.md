## Tiny example

Tree vocabulary on

```
      1
     / \
    2   3
   /
  4
```

- **Depth** of 4: 2 edges from root (if counting edges)
- **Height** of tree: longest root→leaf path edges (2 here)
- **Perfect / full / complete**: different shape constraints — complete is heap-shaped; perfect is every level full

Interview follow-ups love these words — keep definitions consistent.


## How

1. Pick edge-count vs node-count convention and stick to it
2. Classify shape words carefully
3. Use complete-tree indexing only when the shape qualifies


## Trap

Calling any bushy tree “complete”.

**Fix:** Complete ≈ filled level-by-level left-justified (heap shape).

**Note:** definitions vary slightly by textbook — state yours

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
