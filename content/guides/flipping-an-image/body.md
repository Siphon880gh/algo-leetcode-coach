## One pass per row

For each row, `l = 0`, `r = n − 1`. While `l ≤ r`:

- `row[l], row[r] = row[r] ^ 1, row[l] ^ 1`.
- `l += 1`, `r −= 1`.

When `l == r`, both sides of the assignment refer to the same cell, so it is simply inverted.

Observation: if `row[l] ≠ row[r]`, swapping and inverting leaves both unchanged; only equal pairs flip. That gives a branchy but equivalent version.

Two separate passes (reverse, then invert) are also correct; the combined pass just does it in one sweep. Do not forget the middle element.

Time: O(n²)  
Space: O(1)

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
