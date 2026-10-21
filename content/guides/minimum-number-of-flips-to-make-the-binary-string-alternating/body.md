## Rotations as windows

1. `t = s + s`; patterns `p0 = 0101…`, `p1 = 1010…` of length `2n`.
2. Slide a length-`n` window: add the incoming index's mismatches against `p0` and `p1`, remove the outgoing index's.
3. For each full window, `best = min(best, d0, d1)`.

`"111000"` → 2. `"010"` → 0. `"1110"` → 1. Checked against brute force over all rotations.

A window in `t` starting at `j` is the rotation by `j`; comparing to `p0`/`p1` at the same offset covers both alternating targets. For even `n`, rotation never helps, but the window handles both cases uniformly.

Time: O(n)  
Space: O(n), or O(1) with index arithmetic

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
