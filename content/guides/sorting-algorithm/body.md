## Tiny example

Same input `[3, 1, 4, 2]` under different tools:

| Algorithm | Typical time | Extra space | Notes |
|-----------|--------------|-------------|-------|
| Insertion | O(n²) / O(n) best | O(1) | Great nearly sorted |
| Merge | Θ(n log n) | Θ(n) | Stable |
| Quick | avg O(n log n) | O(log n) | Watch worst case |
| Heap | O(n log n) | O(1) | Not stable |


## How

1. Identify constraints: stability? memory? input distribution?
2. Pick a tool that matches (library sort is usually introsort/timsort)
3. For interviews, know the invariants and traps of each classic sort


## Trap

Memorizing one Big-O and applying it to every sort situation.

**Fix:** Ask: stable? in-place? guaranteed n log n? tiny n? integers with small range?

**Time/Space:** depends on the chosen algorithm — see table

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
