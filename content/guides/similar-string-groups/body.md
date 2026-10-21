## Graph of similar words

1. Union-find over the word indexes.
2. For every pair `i < j`, if `similar(words[i], words[j])`, union them. `similar` counts mismatched positions and stops after 2; it is true for 0 or 2 mismatches (all words are anagrams, so exactly 2 mismatches means one swap).
3. Return the number of distinct roots.

Groups are transitive through chains: `"tars"` and `"arts"` are not similar to each other directly, but both join `"rats"`, so they share a group.

Cost: O(n² · L). When `n` is large and `L` small, instead generate all O(L²) swaps of each word and look them up in a set.

Do not require every pair in a group to be similar; similarity only needs to chain. Do not count exactly 1 mismatch as similar; anagrams cannot differ in one position.

Time: O(n² · L · α(n))  
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
