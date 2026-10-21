## Balance sets

1. If `m + n − 1` is odd, return false.
2. `B[i][j]` = `{b + d : b ∈ B[i − 1][j] ∪ B[i][j − 1], b + d ≥ 0}`, with `d = +1` for `(` and `−1` for `)`, starting from `{0}` before the first cell.
3. Return `0 ∈ B[m − 1][n − 1]`.

Examples → true, false. Checked against trying every monotone path on 500 small grids.

A balance above the number of cells left can never return to 0, so it may be dropped; a bitset per cell makes each merge one OR. m, n ≤ 100.

Time: O(m · n · (m + n))  
Space: O(m · n · (m + n))

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
