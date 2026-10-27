## Greedy from z down

1. Counts `c[a … z]`; `i` = largest letter left.
2. Write `min(c[i], repeatLimit)` copies of `i`.
3. If `c[i]` is still positive: find the largest `j < i` with copies left; if none, stop; write one `j` and go to step 2.
4. Otherwise move `i` down to the next letter with copies.

Examples → `zzcccac`, `bbabaa`. Checked against trying every arrangement of every subset on 200 random short strings.

Using only one smaller letter as a break keeps as many large letters as possible in front. Unused letters at the end are allowed.

Time: O(n + 26)  
Space: O(26)

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
