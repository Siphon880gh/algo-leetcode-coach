## DFS with a path counter

1. key[i] = nums[i] with every squared prime factor removed (sieve or trial division).
2. DFS from 0: on entering u, add count[key[u]] to the total, then count[key[u]] += 1; on leaving u, count[key[u]] −= 1.
3. Return the total.

Examples → 3, 1, 2. Checked against testing every ancestor on 1,500 random trees.

Comparing the values themselves: example 1 → 1 instead of 3 (8 · 2 = 16 is a square).

Time: O(n · √V) with trial division, V = max value  
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
