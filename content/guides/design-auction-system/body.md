## Map plus heap

1. bids[item][user] = amount.
2. addBid / updateBid: set the map entry and push (−amount, −user) on heap[item].
3. removeBid: delete the map entry.
4. getHighestBidder: while the heap top disagrees with the map, pop it. Return its user, or −1 if empty.

Example → [2, 1, 1, −1]. Checked against a direct maximum on 1,500 random call lists.

Breaking ties toward the smaller userId: constructed check (run in code) two bids of 5 by users 1 and 2 → 1 instead of 2.

Time: O(log N) amortized per call  
Space: O(N), N = calls

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
