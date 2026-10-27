## Run stack

1. Stack of [char, count].
2. For each c: grow the top run if it has the same char, else push [c, 1].
3. If the top is [")", k] and the run below is "(" with count ≥ k: pop the top, subtract k from the run below, and pop it if it reaches 0.
4. Return the runs joined.

Examples → "", "((", "()()()". Checked against repeated rounds of removal on 4,000 random strings.

Stopping after one round of removals: example 1 → "()" instead of "".

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
