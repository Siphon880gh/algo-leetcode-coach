## Two checks per query

1. h[v] = random 64-bit value; P[i + 1] = P[i] XOR h[nums[i]].
2. Even counts ⇔ P[r + 1] = P[l].
3. Sort queries by r. Moving the right end to i: remove the mark at last[nums[i]], mark i. Distinct in [l, r] = marks in [l, r].
4. Answer = (distinct = k) and even counts.

Examples → [false, true, false], [true, false]. Matched direct counting on 2,000 random cases.

XOR-ing the values themselves instead of random hashes: constructed check (run in code) nums = [1, 2, 3], k = 3, query [0, 2] → true instead of false, since 1 XOR 2 XOR 3 = 0.

Time: O((n + q) log n)  
Space: O(n + q)

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
