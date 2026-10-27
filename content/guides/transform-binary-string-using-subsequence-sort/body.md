## Check each pattern

1. K = ones in s. For a pattern: f = fixed ones, q = '?' count, need = K − f. Need outside [0, q] → false.
2. Fill the last need '?' slots with 1 and the rest with 0.
3. True if every prefix of the result has at most as many ones as s.

Examples → [true, true, false], [true, false, true], [true]. Matched breadth-first search over sort operations for every s and pattern with n ≤ 5.

Putting the ones in the first '?' slots: constructed check (run in code) s = "01", pattern "??" → false instead of true.

Time: O(n · |strs|)  
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
