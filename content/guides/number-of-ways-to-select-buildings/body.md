## Middle times both sides

1. `z`, `o` = totals; `lz`, `lo` = counts seen so far.
2. At a `0`: add `lo · (o − lo)`, then `lz += 1`. At a `1`: add `lz · (z − lz)`, then `lo += 1`.
3. Return the sum.

Examples → 6, 0. Checked against every triple on 300 random strings.

Only the middle can conflict with both neighbours, so fixing it splits the count into independent left and right choices. Counts reach about 4 · 10^13, so use 64-bit.

Time: O(n)  
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
