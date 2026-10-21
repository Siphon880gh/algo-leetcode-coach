## Two candidate targets

1. `ones`, `zeros`; if `|ones − zeros| > 1` → −1.
2. Pattern starting with `0` is valid when `zeros ≥ ones`; starting with `1` when `ones ≥ zeros`.
3. For each valid pattern: `mismatches / 2`; return the minimum.

`"111000"` → 1. `"010"` → 0. `"1110"` → −1.

Each swap fixes one misplaced 0 and one misplaced 1, hence the halving. An invalid pattern can give an odd mismatch count, so check validity first.

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
