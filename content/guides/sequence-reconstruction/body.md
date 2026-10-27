`nums` is a permutation of `1..n` (n up to 1e4). `sequences` holds subsequences of `nums`. Return true if `nums` is the only shortest sequence that contains every `sequences[i]` as a subsequence. `nums = [1,2,3]`, `[[1,2],[1,3]]` → false (`[1,3,2]` also works). `[[1,2]]` → false (3 is never constrained). `[[1,2],[1,3],[2,3]]` → true. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Unique topological order

Each adjacent pair `a, b` inside a sequence is an edge `a → b` (a must come before b). Count in-degrees. Run Kahn’s algorithm: start with every node of in-degree 0. The order is unique exactly when the queue holds one node at every step — two ready nodes means either could go next. Pop the single node, decrement its neighbors, enqueue those that reach 0. Return true only if every node was popped this way.

Since `nums` is itself a valid order, you can also just check that each consecutive pair `nums[i], nums[i+1]` appears as an adjacent pair in some sequence — that edge is what forces their order.

Course Schedule II (210) returns any valid order. Alien Dictionary (269) builds edges from the first differing letter.

Do not only check that `nums` is consistent with the sequences — it must also be the only order. Do not add edges between non-adjacent elements; adjacent pairs are enough.

Time: O(n + total sequence length)  
Space: O(n + edges)

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
