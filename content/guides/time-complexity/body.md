## Tiny example

Two snippets on size `n`:

- Triple nested loops over `n` → about `n³` iterations → **O(n³)**
- `for i in 0..n: for j in 0..i: …` → about `n²/2` → still **O(n²)** (drop constants)

Big-O names the **growth class**, not the exact millisecond count.


## How

1. Count dominant operations as a function of n
2. Drop constants and lower-order terms
3. Report worst case unless asked otherwise


## Trap

Saying “O(2n) is worse than O(n)” as if constants mattered in Big-O notation.

**Fix:** O(2n) and O(n) are the same class. Compare algorithms by class, then by constants via benchmarks.

**Note:** Big-O is asymptotic; measure wall clocks for constants/cache.

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
