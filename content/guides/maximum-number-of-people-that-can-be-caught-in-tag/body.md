In an array team, 1 marks a person who is "it" and 0 marks a person who is not. Each "it" person can catch at most one non-"it" person within distance dist (indices i − dist … i + dist), and each person can be caught once. Return the maximum number caught. For instance, [0,1,0,1,0] with dist 3 → 2; [1] with dist 1 → 0; [0] with dist 1 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Match left to right

1. `its`, `non` = indices of 1s and 0s.
2. `i = j = 0`: if `|its[i] − non[j]| ≤ dist`, count and advance both; elif `non[j] < its[i]`, `j += 1`; else `i += 1`.

Constructed checks (verified against exhaustive matching on random arrays): the three cases above → 2, 0, 0.

Skipping the smaller index is safe: it is too far left for the current partner and every later one. Matching the leftmost available pair never blocks a better matching.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
