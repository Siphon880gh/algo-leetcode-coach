## Adjacent pairs are enough

`rank[c]` = index of `c` in `order`.

For each adjacent pair `(a, b)`:

1. Find the first index where they differ.
2. If found: if `rank[a[i]] > rank[b[i]]`, return false; otherwise the pair is fine.
3. If not found (one is a prefix of the other): if `len(a) > len(b)`, return false.

Return true.

Sorted order is transitive, so checking neighbors covers every pair.

Do not compare all letters of the words; only the first difference matters. Do not forget the prefix case: `"apple"` before `"app"` is wrong.

Time: O(total letters)  
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
