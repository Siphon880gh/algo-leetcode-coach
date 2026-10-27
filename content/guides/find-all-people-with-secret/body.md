## Same-time meetings spread together

1. `know = {0, firstPerson}`; sort meetings by time.
2. For each time: build a graph of that time's meetings; BFS from people in it who already know; everyone reached learns the secret.
3. Return `know` (any order).

Examples → `[0,1,2,3,5]`, `[0,1,3]`, `[0,1,2,3,4]`.

Within one time the secret can travel through several meetings instantly (Example 3), but it cannot go back in time to an earlier meeting. With union-find, union each group and then reset the people not connected to someone who knows.

Time: O(M log M + n)  
Space: O(n + M)

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
