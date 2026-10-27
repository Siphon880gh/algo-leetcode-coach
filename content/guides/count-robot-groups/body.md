## Example first

position = [1, 5, 6, 20], speed = [4, 3, 2, 3], distance = 1.

1. At t = 0 the robots at 5 and 6 are 1 apart, so they merge. The group moves like its rightmost robot: from 6 at speed 2.
2. The robot at 1 has speed 4. The gap to the group is 6 − 1 − 1 = 4 and closes at 4 − 2 = 2 per second, so it joins at t = 2.
3. Nobody catches the robot at 20. Answer 2.

## Why scan from the right

A group always moves exactly like its rightmost robot, so robots on the left never change what happens on the right. For robot i, the thing ahead is "the group that holds robot i + 1". Its leader changes whenever that group joins a group further right, and each change makes it jump forward, never back.

## Steps

1. Scan i from n − 1 down to 0 with a stack of leaders. Entry j stores T_j, the time robot j joins the group ahead (infinity if never). Deeper entries have larger T.
2. For robot i, walk the stack from the top. Entry j is the group ahead during the window [start, T_j], where start is the T of the entry popped before it (0 at first).
3. Inside that window the gap is position[j] − position[i] − distance + (speed[j] − speed[i]) · t. Take the first t in the window where it is ≤ 0: either t = start, or the root of that line when robot i is faster.
4. If no window works, T_i = infinity. Pop every entry with T_j ≤ T_i and push i.
5. The answer is how many robots have T_i = infinity.

Times are ratios of integers up to 10^9. Compare them exactly with fractions or cross-multiplication.

## Trap

Comparing each robot only with the robot right in front. position = [1, 3, 4], speed = [4, 2, 4], distance = 1: robots 2 and 3 merge at t = 0 and the group runs at speed 4, so robot 1 never catches up. The neighbour-only rule sees robot 1 faster than robot 2 and gives 1 group instead of 2.

Checked: the examples give 2, 2 and 1, and the stack matched an exact event-by-event simulation on 300 random small cases.

Time: O(n) amortized  
Space: O(n)

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
