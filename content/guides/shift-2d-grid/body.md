## Index arithmetic

1. `total = m · n`, `k %= total`.
2. For each `(r, c)`: `j = (r · n + c + k) % total`; `out[j // n][j % n] = grid[r][c]`.

`[[1,2,3],[4,5,6],[7,8,9]]`, k = 1 → `[[9,1,2],[3,4,5],[6,7,8]]`. k = 9 → unchanged.

Do not simulate k single shifts; reduce `k` first. Do not shift rows and columns separately; the shift runs across row ends.

Time: O(m · n)  
Space: O(m · n) for the output

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
