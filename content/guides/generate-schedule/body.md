## Greedy in a good order

1. If n < 5, return [].
2. Pool: for d = 1 … n − 1, for i in 0, 2, 4, … then 1, 3, 5, …: add (i, (i + d) mod n). Every ordered pair appears once.
3. Repeat: take the first match in the pool with no team in common with the last match scheduled.

Checked in code that the result is a valid schedule for every n from 5 to 50.

Listing i in plain order 0, 1, 2, … instead: the greedy gets stuck at n = 6.

Time: O(n⁴) in the worst case (n² matches, each scanning the pool)  
Space: O(n²)

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
