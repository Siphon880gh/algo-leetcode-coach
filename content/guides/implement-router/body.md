## Three structures

1. q = deque of packets; seen = set of (source, destination, timestamp); ts[d] = list of timestamps; start[d] = how many of them have left.
2. addPacket: duplicate → false. If full, forward (drop) the oldest. Append everywhere; true.
3. forwardPacket: pop from q, remove from seen, start[d] += 1.
4. getCount: binary search [startTime, endTime] in ts[d] from start[d] on.

Examples → [null, true, true, false, true, true, [2, 5, 90], true, 1], [null, true, [7, 4, 90], []].

Not advancing start[d] when the memory limit evicts a packet: Router(2), add (1, 5, 100), (2, 5, 101), (3, 5, 102), getCount(5, 100, 102) → 3 instead of 2.

Time: O(log n) per call  
Space: O(memoryLimit + calls)

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
