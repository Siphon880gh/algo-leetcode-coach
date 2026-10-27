You are given the head of a linked list. Return the head of a new linked list that holds, once for each distinct value, how many times that value occurs. The allowed output order is in the official statement. Limits are in the official statement. For instance, values 1, 1, 2, 1, 2, 3 → counts 3, 2, 1 (for 1, 2 and 3). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count and rebuild

1. Walk the list; cnt[val] += 1 (an insertion-ordered map keeps first-appearance order).
2. Build a new list with one node per count.

Constructed checks (run in code): the example above; 1, 1, 2, 2, 2 → 2, 3; six distinct values → six 1s.

Emit one node per distinct value, not per node: writing cnt[val] at every node gives 3, 3, 2, 3, 2, 1 for the example.

Time: O(n)  
Space: O(number of distinct values)

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
