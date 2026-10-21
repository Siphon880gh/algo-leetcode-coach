## Replace, do not add

`end = [0] * 26`. For each character `c`:

- `end[c] = (sum(end) + 1) % (10⁹ + 7)`.

Return `sum(end) % (10⁹ + 7)`.

Why replace: every subsequence that used to end in `c` can be rebuilt by taking an earlier distinct subsequence and appending this new `c`. So the new set of subsequences ending in `c` contains the old one, and its size is exactly (all distinct subsequences so far) + 1 for `"c"` alone.

Keep a running total to make each step O(1): `total = total − old + new`.

Do not double every count per character without removing duplicates; repeated letters would be counted twice. Do not include the empty subsequence in the answer.

Time: O(n)  
Space: O(1)

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
