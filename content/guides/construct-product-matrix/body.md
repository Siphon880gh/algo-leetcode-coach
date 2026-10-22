## Two passes

1. Flatten to f. `pre[i]` = product of f[0 … i − 1] mod 12345.
2. Walk back with a running suffix: `ans[i] = pre[i] · suf % 12345`, then `suf = suf · f[i] % 12345`.
3. Reshape.

Examples → [[24, 12], [8, 6]], [[2], [0], [0]]. Checked against direct products on 300 random grids.

12345 = 3 · 5 · 823, so values sharing a factor with it (like 12345 itself) have no modular inverse; dividing the total product fails.

Time: O(nm)  
Space: O(nm)

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
