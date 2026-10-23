## Simulate

1. seen = {}, cur = "".
2. For each character: cur += c; if cur ∉ seen, add it, append it to the answer, cur = "".
3. A leftover cur at the end is already seen, so it is dropped.

Examples → [a, b, bc, c, cc, d], [a, aa].

Every prefix of the current piece was seen earlier, so a piece of length L needs L − 1 earlier pieces of lengths 1 … L − 1; L is at most about √(2n). A trie walk makes it O(n).

Appending the leftover piece: example 2 → [a, aa, a] instead of [a, aa].

Time: O(n√n) with a hash set, O(n) with a trie  
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
