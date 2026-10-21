## Smallest subsequence with two guards

`rem` = letters not yet scanned, `inSt` = letters on the stack.

For each `ch` (index `i`):

1. While the top is larger than `ch`, `len(stack) − 1 + (n − i) ≥ k`, and (top is not the letter or `inSt − 1 + rem ≥ repetition`): pop (update `inSt`).
2. If `len(stack) < k`: push `ch` if it is the letter; otherwise push only if `k − len(stack) > repetition − inSt`.
3. If `ch` is the letter, `rem −= 1`.

Examples → `"eet"`, `"ecde"`, `"bb"`. Checked against every length-k subsequence on random strings.

The first guard keeps enough characters to reach length k; the letter guard keeps enough copies of the letter; the push guard reserves slots for letters still needed.

Time: O(n)  
Space: O(k)

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
