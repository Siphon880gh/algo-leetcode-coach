## Tiny example

Sort `[3, 1, 4, 2]`.

1. Split → `[3, 1]` and `[4, 2]`
2. Sort left → `[1, 3]`; sort right → `[2, 4]`
3. Merge two sorted runs:

```
i on [1, 3], j on [2, 4]
take 1 → take 2 → take 3 → take 4
result [1, 2, 3, 4]
```

## How

1. If length ≤ 1, return
2. Recursively sort left and right halves
3. Merge into a temporary buffer by always taking the smaller head
4. Copy back (or build a new array)

## Trap

Forgetting the **O(n) auxiliary** buffer and claiming “in-place like heapsort”.

**Fix:** Classic merge sort uses **Θ(n)** extra space. Time is **Θ(n log n)** comparisons in all cases — stable if you break ties toward the left run.

**Time:** Θ(n log n)  
**Space:** Θ(n)

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
