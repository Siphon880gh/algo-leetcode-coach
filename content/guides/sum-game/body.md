## Mirror strategy

1. `s1, s2` = digit sums of each half; `q1, q2` = question marks in each half.
2. If `q1 + q2` is odd → true.
3. Else return `2 · (s1 − s2) ≠ 9 · (q2 − q1)`.

`"5023"` → false. `"25??"` → true. `"?3295???"` → false. Checked against a full game search on small cases.

Intuition: paired ? on the same side cancel to a fixed 9 (Bob answers x with 9 − x); paired ? across sides cancel entirely. Bob wins only if those fixed contributions close the gap exactly.

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
