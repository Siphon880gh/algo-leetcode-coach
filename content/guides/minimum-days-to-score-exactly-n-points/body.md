## Example first

n = 9.

1. Days 1 to 3 earn 1, 2, 3. Score 6.
2. Day 4 is a skip, which resets the streak.
3. Days 5 and 6 earn 1 and 2. Score 9 after 6 days.

n = 2 needs 3 days: earn 1, skip, earn 1. Earning on day 2 would add 2 and overshoot.

## Idea

A streak of j days scores T(j) = j(j + 1) / 2. Every streak except the last is followed by one skip. So each streak is a knapsack item worth T(j) points that costs j + 1 days. Setting f[0] = −1 cancels the skip after the last streak.

## Steps

1. f[0] = −1 and f[x] = infinity for x ≥ 1.
2. For x from 1 to n, for every j with T(j) ≤ x: f[x] = min(f[x], f[x − T(j)] + j + 1).
3. Return f[n].

Only about √(2n) streak lengths fit under each x.

## Trap

Forgetting the skip day and charging j days per streak. n = 2 then gives 2 instead of 3, because two earning days in a row score 1 + 2, not 1 + 1. Fix: charge j + 1 and start from f[0] = −1.

Checked: the examples give 3, 6 and 7, and the table matched a breadth-first search over (score, streak) for 300 random n.

Time: O(n√n)  
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
