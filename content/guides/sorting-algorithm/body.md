## Tiny example

The same input, `[3, 1, 4, 2]`, could be sorted by any of these:

| Algorithm | Typical time | Extra space | Notes |
|-----------|--------------|-------------|-------|
| Insertion | O(n²), or O(n) at best | O(1) | great when nearly sorted |
| Merge | Θ(n log n) | Θ(n) | stable |
| Quick | O(n log n) on average | O(log n) | watch the worst case |
| Heap | O(n log n) | O(1) | not stable |

## How

1. Identify the constraints. Do you need stability? How much memory is there? What does the input look like?
2. Pick an algorithm that fits. Library sorts are usually introsort or Timsort.
3. For interviews, know the invariant and the trap of each classic sort.

## Trap

Memorizing one Big-O and applying it to every sorting situation.

**Fix:** Ask these questions:

- Does it need to be stable?
- Does it need to be in place?
- Do you need a guaranteed n log n?
- Is n tiny?
- Are the keys integers in a small range?

**Time and space:** depend on the algorithm, as shown in the table

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
