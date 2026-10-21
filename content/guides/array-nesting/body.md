## Permutations are disjoint cycles

Each index has exactly one next index and exactly one previous one, so following `nums` from any `k` loops back to `k` and the indexes form separate cycles. `s[k]` is the cycle through `k`, and every member of that cycle gives the same set.

For each unvisited `i`, walk `j = nums[j]` while not visited, marking and counting. Track the largest count. Each index is visited once.

You can mark in place (for example set `nums[j] = n`) to use O(1) extra space.

Do not walk from every `k` without marks — that repeats each cycle once per member, O(n²). Do not store a set per start; a counter is enough because the cycle ends when it reaches a marked index.

Time: O(n)  
Space: O(n), or O(1) by marking in place

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
