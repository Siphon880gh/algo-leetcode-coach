## Two cases

1. `ones` = count of 1s; if `ones > 0`, return `n − ones`.
2. For each start i, extend j while tracking `g = gcd(nums[i..j])`; record the smallest `j − i + 1` with `g = 1`.
3. No such window → −1. Otherwise return `(L − 1) + (n − 1)`.

Examples → 4, −1. Checked against breadth-first search over all arrays on 400 random small inputs.

Each operation creates at most one new 1, so with no 1s present you first need L − 1 steps to create one, and then each of the other n − 1 elements needs its own step.

Time: O(n² log max)  
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
