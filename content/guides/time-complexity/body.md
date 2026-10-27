## Tiny example

Two snippets on input size `n`:

- Three nested loops over `n` run about `n³` times, which is **O(n³)**.
- `for i in 0..n: for j in 0..i: …` runs about `n²/2` times, which is still **O(n²)**, because constants are dropped.

Big-O names the **growth class**, not the exact number of milliseconds.

## How

1. Count the main operations as a function of n.
2. Drop constants and lower-order terms.
3. Report the worst case unless asked otherwise.

## Trap

Saying "O(2n) is worse than O(n)", as if constants mattered in Big-O notation.

**Fix:** O(2n) and O(n) are the same class. Compare algorithms by class first, then compare constants with benchmarks.

**Note:** Big-O describes growth for large n. Measure real times to see constants and cache effects.

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
