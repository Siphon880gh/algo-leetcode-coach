## Keep a prefix and a suffix

1. `L[i]`: the s position just after greedily matching `t[0 … i − 1]` from the left (stop when it fails).
2. `R[j]`: the s position where `t[j …]` starts when matched greedily from the right; `R[m] = n`.
3. For each matchable prefix length `i`, move `j ≥ i` forward until `R[j] ≥ L[i]`; take `min(j − i)`.
4. Return that minimum.

Examples → 1, 3. Checked against trying every deleted block on 500 random cases.

Keeping more of t is never cheaper than removing a whole block between left and right, so the score depends only on which prefix and suffix stay. Both L and R only move one way, so j never goes back.

Time: O(n + m)  
Space: O(m)

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
