## Example first

availableIntervals = [[1, 2], [3, 4]], targetIntervals = [[1, 4]].

Every integer from 1 to 4 is covered, but 2.5 lies in neither interval. Real points count, so the answer is −1.

Example 1 has targets covering [1, 5], [7, 8] and [10, 15]. The greedy picks [1, 7], then [5, 10], then [10, 15]. Answer 3.

## Steps

1. Sort available intervals and targets by start.
2. cur = how far the selected intervals reach (start at 0). Keep a pointer i into the available list.
3. For each target [l, r], while cur < r:
4. The first point still uncovered is u = max(l, cur).
5. Scan available intervals with start ≤ u and remember the farthest end nxt.
6. If nxt < u, or nxt = cur, a real gap remains: return −1.
7. Otherwise set cur = nxt and count one interval.

Intervals passed over in earlier rounds ended at or before the cur chosen then, so they never help later.

## Trap

Checking only integer points. Example 3 then gives 2 instead of −1. Fix: coverage must be continuous, which closed intervals give when each next pick starts at or before the current reach.

Checked: the examples give 3, −1 and −1, and the greedy matched trying every subset with half-unit points on 300 random cases.

Time: O(A log A + T log T)  
Space: O(1) beyond sorting

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
