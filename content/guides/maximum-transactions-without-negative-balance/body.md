Given a list of transactions in order, where a positive amount adds money and a negative amount takes it away, you may skip any of them. Starting from a balance of 0, the balance must never go below 0. Return the largest number of transactions you can perform. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Min-heap

1. balance = 0; count = 0; heap = [].
2. For each x: balance += x; push x; count += 1.
3. If balance < 0: balance −= pop the smallest; count −= 1.
4. Return count.

Constructed checks (made-up values, run in code): [4, −2, −3, 1] → 3; [−1, 5, −6, 2, −1] → 3; [−3] → 0. Checked against trying every subset on 3,000 random arrays.

Skipping a transaction only when it would make the balance negative: [3, −3, −1, −1] → 2 instead of 3.

Time: O(n log n)  
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
