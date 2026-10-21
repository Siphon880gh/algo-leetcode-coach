## A pointer into the runs

Store `enc` and `i = 0` (the count of the current run is `enc[i]`, its value `enc[i + 1]`).

`next(n)`:

1. While `i < len(enc)` and `enc[i] < n`: `n −= enc[i]`; `i += 2`.
2. If `i ≥ len(enc)`, return −1.
3. `enc[i] −= n`; return `enc[i + 1]`.

Runs with count 0 are skipped by the loop whenever `n ≥ 1`.

Do not expand the encoding; counts reach 10⁹. Once the runs are exhausted, `i` stays at the end, so later calls keep returning −1.

Time: O(1) amortized per call (each run is skipped once)  
Space: O(1) beyond the encoding

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
