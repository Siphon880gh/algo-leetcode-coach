## Rank by counting

1. `h = column`, `v = row`.
2. While both remain: `w = C(h + v − 1, v)` (strings starting with H).
3. If `k ≤ w`: append H, `h −= 1`; else append V, `k −= w`, `v −= 1`.
4. Append the rest (all H or all V).

`[2,3]`: k = 1 → `"HHHVV"`, k = 2 → `"HHVHV"`, k = 3 → `"HHVVH"`.

H sorts before V, so the H-first block comes first. Do not generate all `C(30, 15)` strings.

Time: O((r + c)²) with Pascal's triangle  
Space: O((r + c)²)

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
